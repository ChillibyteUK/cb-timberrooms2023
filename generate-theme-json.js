// generate-theme-json.js
// Parses _tokens.scss and generates theme.json for WordPress block editor sync.

const fs = require("fs");
const path = require("path");

const scssFile = path.join(__dirname, "src/sass/theme/_tokens.scss");
const themeJsonFile = path.join(__dirname, "theme.json");

// Parse CSS custom properties from :root block
function parseCssVariables(scssContent) {
  const rootBlockMatch = scssContent.match(/:root\s*{([\s\S]*?)}/);
  if (!rootBlockMatch) return {};
  const rootContent = rootBlockMatch[1];
  const varRegex = /--([\w-]+):\s*([^;]+);/g;
  const tokens = {};
  let match;
  while ((match = varRegex.exec(rootContent)) !== null) {
    tokens[match[1]] = match[2].trim();
  }
  return tokens;
}

function buildThemeJson(tokens) {
  // Resolve hsl(var(--hsl-col-*)) references to actual hsl() values
  function resolveColorValue(value) {
    const hslVarMatch = value.match(/^hsl\(var\(--([\w-]+)\)\)$/);
    if (hslVarMatch) {
      const hslKey = hslVarMatch[1];
      if (tokens[hslKey]) return `hsl(${tokens[hslKey]})`;
    }
    return value;
  }

  // Colors: vars starting with col-, excluding hsl- companions and var() aliases
  const colors = Object.entries(tokens)
    .filter(
      ([key, value]) =>
        key.startsWith("col-") &&
        !key.startsWith("col-white-") && // exclude alpha variants from palette
        !key.startsWith("col-black-") &&
        !value.startsWith("var("), // exclude aliases like --col-body: var(--col-white)
    )
    .map(([key, value]) => ({
      name: key.replace("col-", ""),
      slug: key.replace("col-", ""),
      color: resolveColorValue(value),
      origin: "theme",
    }));

  // Font sizes: vars starting with fs-
  const fontSizes = Object.entries(tokens)
    .filter(
      ([key, value]) => key.startsWith("fs-") && !value.startsWith("var("), // exclude --fs-body: var(--fs-400) alias
    )
    .map(([key, value]) => ({
      name: key.replace("fs-", ""),
      slug: key.replace("fs-", ""),
      size: value,
    }));

  return {
    version: 2,
    settings: {
      layout: {
        contentSize: "1360px",
        wideSize: "1600px",
      },
      spacing: {
        blockGap: true,
        margin: true,
        padding: true,
        units: ["px", "em", "rem", "vh", "vw", "%"],
      },
      color: {
        palette: colors,
      },
      typography: {
        fontSizes,
      },
    },
    styles: {
      spacing: {
        blockGap: "28px",
      },
    },
  };
}

function main() {
  if (!fs.existsSync(scssFile)) {
    console.error("SCSS tokens file not found:", scssFile);
    process.exit(1);
  }
  const scssContent = fs.readFileSync(scssFile, "utf8");
  const tokens = parseCssVariables(scssContent);
  const themeJson = buildThemeJson(tokens);
  fs.writeFileSync(themeJsonFile, JSON.stringify(themeJson, null, 2));
  console.log("theme.json generated successfully.");
}

main();
