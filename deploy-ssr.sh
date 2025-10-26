#!/bin/bash

# Fast Teknik SSR Deployment Script
# Usage: ./deploy-ssr.sh

set -e

echo "🚀 Starting SSR deployment..."

# Build assets
echo "📦 Building assets..."
npm run build:ssr

# Stop existing PM2 process
echo "⏸️  Stopping existing SSR process..."
pm2 stop turkteknik-ssr 2>/dev/null || true

# Start SSR with PM2
echo "▶️  Starting SSR server..."
pm2 start ecosystem.config.cjs

# Save PM2 configuration
echo "💾 Saving PM2 configuration..."
pm2 save

# Show status
echo "✅ Deployment complete!"
pm2 status
pm2 logs turkteknik-ssr --lines 20

