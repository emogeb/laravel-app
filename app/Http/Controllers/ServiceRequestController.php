<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ServiceRequestController extends Controller
{
    public function create(Request $request)
    {
        // Seçilen servis key ve option ID request query parametrelerinden alınacak
        $serviceKey = $request->query('service');
        $optionId = $request->query('option');

        // Eğer kullanıcı giriş yapmışsa bilgilerini al
        $userData = auth()->check() ? [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => auth()->user()->phone,
            'address' => auth()->user()->address,
        ] : [];

        // Seçilen servis tipine uygun ürünleri çek
        $products = [];
        if ($serviceKey) {
            $categoryMap = [
                'camera' => 'kamera',
                'internet' => 'internet',
                'satellite' => 'çanak anten',
            ];
            $category = $categoryMap[$serviceKey] ?? null;
            if ($category) {
                $products = \App\Models\Product::where('category', $category)->get();
            }
        }

        // Bu bilgileri ServiceRequests/Create sayfasına prop olarak gönderelim
        return Inertia::render('ServiceRequests/Create', [
            'serviceKey' => $serviceKey,
            'optionId' => $optionId,
            'userData' => $userData,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'description' => 'required|string',
            'service_key' => 'required|string|in:camera,internet,satellite',
            'option_id' => 'required|string',
            'product_id' => 'nullable|exists:products,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $serviceRequest = ServiceRequest::create([
            'user_id' => auth()->id(), // Eğer kullanıcı giriş yapmışsa user_id, yapmamışsa null
            'service_type' => $request->service_key, // Hizmet tipini direkt kaydediyoruz
            'service_option' => $request->option_id, // Seçilen opsiyonu kaydediyoruz
            'product_id' => $request->product_id, // Seçilen ürün
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'district' => $request->district,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        // TODO: WhatsApp entegrasyonu
        // TODO: Email bildirimi

        $successData = [
            'title' => 'Hizmet Talebi Oluşturuldu',
            'message' => 'Talebiniz başarıyla alındı. En kısa sürede sizinle iletişime geçeceğiz.',
            'request_number' => $serviceRequest->request_number,
            'service_type' => $this->getServiceTypeText($request->service_key),
            'service_option' => $this->getServiceOptionText($request->service_key, $request->option_id),
            'request_id' => $serviceRequest->id,
        ];

        if (auth()->check()) {
            return redirect()->action([ProfileController::class, 'show'])->with('success', $successData);
        } else {
            return redirect()->route('home')->with('success', $successData);
        }
    }

    public function show(ServiceRequest $serviceRequest)
    {
        $serviceRequest->load('user', 'product');
        return Inertia::render('ServiceRequests/Show', [
            'serviceRequest' => $serviceRequest
        ]);
    }

    public function destroy(ServiceRequest $serviceRequest)
    {
        // Yetkilendirme kontrolü yapılabilir, örneğin sadece talebi oluşturan kullanıcı silebilir
        // if ($serviceRequest->user_id !== auth()->id()) {
        //     abort(403); // Yetkisiz erişim hatası
        // }

        $serviceRequest->delete();

        // Silme işleminden sonra kullanıcıyı profil sayfasına yönlendir ve bir mesaj göster
        return redirect()->route('profile')->with('success', 'Servis talebi başarıyla iptal edildi.');
    }

    private function getServiceTypeText($type)
    {
        return match($type) {
            'camera' => 'Kamera Sistemleri',
            'internet' => 'İnternet Hizmetleri',
            'satellite' => 'Uydu Sistemleri',
            default => 'Bilinmeyen Hizmet'
        };
    }

    private function getServiceOptionText($type, $option)
    {
        $options = [
            'camera' => [
                'camera_ariza' => 'Arıza',
                'camera_kurulum' => 'Kurulum'
            ],
            'internet' => [
                'internet_ariza' => 'Arıza',
                'internet_kurulum' => 'Kurulum ve Altyapı'
            ],
            'satellite' => [
                'satellite_ariza' => 'Anten Arıza',
                'satellite_ayar' => 'Uydu Ayarı'
            ]
        ];

        return $options[$type][$option] ?? 'Bilinmeyen Seçenek';
    }

    public function queryByRequestNumber(Request $request)
    {
        $requestNumber = $request->query('request_number');

        $serviceRequest = null;
        if ($requestNumber) {
            $serviceRequest = ServiceRequest::where('request_number', $requestNumber)->first();
        }

        return Inertia::render('ServiceRequestQuery', [
            'serviceRequest' => $serviceRequest
        ]);
    }
}