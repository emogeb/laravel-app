module.exports = {
  apps: [
    {
      name: 'fastteknik-ssr',
      script: 'bootstrap/ssr/ssr.js',
      node_args: '--enable-source-maps',
      env: {
        NODE_ENV: 'production',
        SSR_PORT: 13714
      },
      instances: 1,
      exec_mode: 'fork',
      watch: false,
      autorestart: true,
      max_memory_restart: '300M',
      error_log: './storage/logs/ssr-error.log',
      out_log: './storage/logs/ssr-out.log',
      time: true,
      merge_logs: true,
      log_date_format: 'YYYY-MM-DD HH:mm:ss Z'
    }
  ]
};

