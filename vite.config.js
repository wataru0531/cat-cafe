import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  plugins: [
    laravel({
      // ✅ Viteの管理対象のファイル
      // → HMRなどのホットリロードの対象
      // ※ bladeファイルなどはLaravelが処理してHTMLを生成するが、
      //   JavaScript、cssはviteで処理を行う

      // public/js/main.js
      // public/css/admin/ これらは別ルート
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
      fonts: [
        bunny('Instrument Sans', {
            weights: [400, 500, 600],
        }),
      ],
    }),
    tailwindcss(),
  ],
  server: {
      watch: {
          ignored: ['**/storage/framework/views/**'],
      },
  },
});
