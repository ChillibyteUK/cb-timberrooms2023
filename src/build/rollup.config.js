"use strict";

const path = require("path");
const { babel } = require("@rollup/plugin-babel");
const { nodeResolve } = require("@rollup/plugin-node-resolve");
const commonjs = require("@rollup/plugin-commonjs");
const multi = require("@rollup/plugin-multi-entry");
const replace = require("@rollup/plugin-replace");
const banner = require("./banner.js");

let bsVersion = 5;
let bsSrcFile = "bootstrap.js";
let fileDest = "child-theme";

const globals = {
  jquery: "jQuery",
  "@popperjs/core": "Popper",
  bootstrap: "bootstrap",
};

const external = ["jquery", "bootstrap"];

const plugins = [
  babel({
    browserslistEnv: `bs${bsVersion}`,
    babelHelpers: "bundled",
  }),
  replace({
    "process.env.NODE_ENV": '"production"',
    preventAssignment: true,
  }),
  nodeResolve(),
  commonjs(),
  multi(),
];

module.exports = {
  input: [
    path.resolve(__dirname, `../js/${bsSrcFile}`),
    path.resolve(__dirname, "../js/skip-link-focus-fix.js"),
    path.resolve(__dirname, "../js/custom-javascript.js"),
  ],
  output: [
    {
      banner: banner(""),
      file: path.resolve(__dirname, `../../js/${fileDest}.js`),
      format: "umd",
      globals,
      name: "understrap",
    },
    {
      banner: banner(""),
      file: path.resolve(__dirname, `../../js/${fileDest}.min.js`),
      format: "umd",
      globals,
      name: "understrap",
    },
  ],
  external,
  plugins,
};
