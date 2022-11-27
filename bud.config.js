/**
 * @typedef {import('@roots/bud').Bud} bud
 *
 * @param {bud} app
 */
/* eslint no-use-before-define: 0 */
const { purgecss } = require('@roots/bud-purgecss');

const fs = require('fs');
const path = require('path');
const { exit } = require('process');

const styleFiles = fs.readdirSync(path.resolve(__dirname, 'resources', 'styles', 'styles'), 'utf-8');
const scriptFiles = fs.readdirSync(path.resolve(__dirname, 'resources', 'scripts', 'modules'), 'utf-8');

const moduleFiles = fs.readdirSync(path.resolve(__dirname, 'resources', 'views', 'blocks'), 'utf-8');

var styleArray = {};
var scriptArray = {};

// var styleArrayDev = {};
var scriptArrayDev = {};

//for build

/**
 * Creating readFile FUnction to read module based
 */

const readFile = (file = null) => {
  if (file == null) return false;
  var filePath = path.resolve(__dirname, 'resources/views', 'blocks', file);

  fs.readFile(filePath, 'utf8', function (err, data) {
    let moduleEnPoints = [];
    if (err) throw err;
    var str = data
      .match(/script\[(.*?)\]script/gi)
      .toString()
      .replace(/script\[(.*?)\]script/gi, '$1');

    // str = str.toString().replace(/script\[(.*?)\]script/ig,"$1");
    str = str.split(',');
    // console.log( str )
    str = str
      .map((object) => {
        var pathResolve = path.resolve(__dirname, 'resources/scripts', 'modules', object);
        if (fs.existsSync(pathResolve)) {
          return pathResolve;
        }
        // return (fs.existsSync(pathResolve)) ? pathResolve : false;
      })
      .filter((obj) => {
        return obj !== undefined;
      });
    var moduleName = path.parse(path.parse(file).name).name;
    // moduleEnPoints['js'] = str;
    moduleEnPoints.push(str);
    str = data
      .match(/style\[(.*?)\]style/gi)
      .toString()
      .replace(/style\[(.*?)\]style/gi, '$1');
    str = str.split(',');
    // console.log( str )
    str = str
      .map((object) => {
        var pathResolve = path.resolve(__dirname, 'resources/styles', 'styles', object);
        if (fs.existsSync(pathResolve)) {
          return pathResolve;
        }
      })
      .filter((obj) => {
        return obj !== undefined;
      });
    moduleName = path.parse(path.parse(file).name).name;
    // moduleEnPoints['css'] = str;
    moduleEnPoints.push(str);

    scriptArrayDev[`dev/${moduleName}`] = moduleEnPoints;
    // console.log( path.parse(path.parse(file).name).name )
    // console.log(scriptArrayDev)
    // console.log('moduleEnPoints',moduleEnPoints)
  });
  return scriptArrayDev;
};

const scriptListFunc = () => {
  let arrayData = [],
    arrayScriptData = [];
  styleFiles.forEach((style) => {
    arrayData.push(path.resolve(__dirname, 'resources/styles', 'styles', style));
  });

  scriptFiles.forEach((script) => {
    arrayScriptData.push(path.resolve(__dirname, 'resources/scripts', 'modules', script));
  });
  let newData = [...arrayData, ...arrayScriptData];
};

let moduleNames = () => {
  console.log('Reading Modules Name');
  let readData;
  var targetFiles = moduleFiles.filter(function (file) {
    return path.extname(file).toLowerCase() === '.php';
  });
  targetFiles.forEach((module) => {
    readData = readFile(module);
  });
  return readData;
};

const moduleDatae = moduleNames();

module.exports = async (app) => {
  /**
   * Assign app state
   */
  const thisDevelopment = app.isDevelopment;
  app.extensions.get('copy-webpack-plugin').setOption('patterns', [
    {
      from: app.path('@src/images'),
      to: app.path('@dist/images'),
    },
  ]);

  app
    /**
     * Application entrypoints
     *
     * Paths are relative to your resources directory
     * Global EntryPoints
     *
     */

    .entry({
      app: ['@scripts/app', '@styles/app'],
      editor: ['@scripts/editor', '@styles/editor'],
    })

    .when(
      thisDevelopment,
      () => {
        console.table('Initiate Dev state');
        scriptArray = moduleNames();
        app.entry(scriptArray);
      },
      () => {
        console.table('Initiate Prod State');
        /**
         * Creating Style files EntryPoints
         * styles/moduleName : " module css file path"
         */
        styleFiles.forEach((style) => {
          styleArray[`styles/${path.parse(style).name}`] = path.resolve(__dirname, 'resources/styles', 'styles', style);
        });
        /**
         * Creating Script files EntryPoints
         * {
         * scripts/moduleName : " module JS file path"
         *
         */
        scriptFiles.forEach((script) => {
          scriptArray[`scripts/${path.parse(script).name}`] = path.resolve(
            __dirname,
            'resources/scripts',
            'modules',
            script
          );
        });
        app.entry(styleArray);
        app.entry(scriptArray);
      }
    )
    .when(
      app.isProduction,
      () => app.template().runtime('single').hash().minimize(),
      () => app.devtool()
    )

    /**
     * Adding Purge CSS to remove unused CSS with whitelisting/safelisting
     */
    .purgecss({
      content: [app.path('resources/views/**')],
      safelist: [...require('purgecss-with-wordpress').safelist, 'aayus', 'body'],
    })
    .template()
    .minimize()
    .hash(false)
    // .entryPoints()
    // .runtime()
    // .splitChunks()
    .hooks.on('build.optimization.splitChunks', (options) => ({
      ...options,
      cacheGroups: {
        vendors: {
          test: app.hooks.filter('pattern.modules'),
          priority: -10,
          reuseExistingChunk: true,
        },
        default: {
          minChunks: 10,
          priority: -20,
          reuseExistingChunk: true,
        },
      },
    }))

    /**
     * These files should be processed as part of the build
     * even if they are not explicitly imported in application assets.
     */
    .assets([
      ['images', 'images'],
      ['fonts', 'fonts'],
    ])

    /**
     * These files will trigger a full page reload
     * when modified.
     */
    // .watch([
    //   'tailwind.config.js',
    //   'resources/views/**/*.blade.php',
    //   'app/View/**/*.php',
    // ])
    /**
     * Watchable files
     */
    .watch('resources/styles/**/*', 'resources/scripts/**/*', 'resources/views/**/*', 'app/**/*')
    .setPublicPath(app.isDevelopment ? '/wp-content/themes/sage10/public/' : '/wp-content/themes/sage10/public/')

    /**
     * Target URL to be proxied by the dev server.
     *
     * This is your local dev server.
     */
    .proxy('http://wordpresstest.local')

    /**
     * Development URL
     */
    .serve('http://wordpresstest.local:3000');
};
