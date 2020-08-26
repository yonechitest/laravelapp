const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.react('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');


mix
  // ビルドしたsassをそれぞれ開発側buildディレクトリへ出力
  .sass('resources/assets/crud/css/crud.scss', '../resources/built/crud/css/')
  .sass('resources/sass/app.scss', 'public/css')
  .react('resources/js/app.js', 'public/js')
  
  // buildディレクトリに出力したcssファイルを、app.cssというファイルに１つにまとめてpublicディレクトリへ出力する
  .styles(
    [
      'resources/built/crud/css/crud.css'
    ],
    'public/css/crud/app.css'
  )
  // app.jsというファイルに１つにまとめてpublicディレクトリへ出力する
  .js(
    [
      'resources/assets/crud/js/crud.js',
    ],
    'public/js/crud/app.js'
  );


/* 
# 上記ソースbuild
 npm run dev

 # 上記ソースbuild & minify
 npm run production
 */