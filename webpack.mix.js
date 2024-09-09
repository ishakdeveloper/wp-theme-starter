const mix = require("laravel-mix");
const domain = "perlui.test"; //
const homedir = require("os").homedir();

mix
  .js("src/js/main.js", "build/js/main.js")
  .sass("src/scss/editor-style.scss", "build/css/editor-style.css")
  .sass("src/scss/main.scss", "build/css/main.css")
  .copyDirectory("src/fontawesome", "build/fontawesome")
  .copyDirectory("src/images", "build/images")
  .copyDirectory("src/fonts", "build/fonts")
  .options({
    processCssUrls: false,
  })
  .browserSync({
    proxy: "https://" + domain,
    host: domain,
    open: "external",
    https: {
      key:
        homedir +
        "/Library/Application Support/Herd/config/valet/Certificates/" +
        domain +
        ".key",
      cert:
        homedir +
        "/Library/Application Support/Herd/config/valet/Certificates/" +
        domain +
        ".crt",
    },
    files: [`**/*.php`, `**/*.js`, `**/*.css`, `**/*.scss`],
  });
