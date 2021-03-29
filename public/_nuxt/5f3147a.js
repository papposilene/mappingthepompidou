(window.webpackJsonp=window.webpackJsonp||[]).push([[1],{154:function(n,e,t){t(155),n.exports=t(156)},191:function(n,e,t){var content=t(192);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[n.i,content,""]]),content.locals&&(n.exports=content.locals);(0,t(103).default)("7122095f",content,!0,{sourceMap:!1})},192:function(n,e,t){var o=t(102)((function(i){return i[1]}));o.push([n.i,'/*! tailwindcss v2.0.3 | MIT License | https://tailwindcss.com*/\n\n/*! modern-normalize v1.0.0 | MIT License | https://github.com/sindresorhus/modern-normalize */\n\n/*\nDocument\n========\n*/\n\n/**\nUse a better box model (opinionated).\n*/\n\n*,\n*::before,\n*::after {\n  box-sizing: border-box;\n}\n\n/**\nUse a more readable tab size (opinionated).\n*/\n\n:root {\n  -moz-tab-size: 4;\n  -o-tab-size: 4;\n     tab-size: 4;\n}\n\n/**\n1. Correct the line height in all browsers.\n2. Prevent adjustments of font size after orientation changes in iOS.\n*/\n\nhtml {\n  line-height: 1.15; /* 1 */\n  -webkit-text-size-adjust: 100%; /* 2 */\n}\n\n/*\nSections\n========\n*/\n\n/**\nRemove the margin in all browsers.\n*/\n\nbody {\n  margin: 0;\n}\n\n/**\nImprove consistency of default fonts in all browsers. (https://github.com/sindresorhus/modern-normalize/issues/3)\n*/\n\nbody {\n  font-family:\n\t\tsystem-ui,\n\t\t-apple-system, /* Firefox supports this but not yet `system-ui` */\n\t\t\'Segoe UI\',\n\t\tRoboto,\n\t\tHelvetica,\n\t\tArial,\n\t\tsans-serif,\n\t\t\'Apple Color Emoji\',\n\t\t\'Segoe UI Emoji\';\n}\n\n/*\nGrouping content\n================\n*/\n\n/**\n1. Add the correct height in Firefox.\n2. Correct the inheritance of border color in Firefox. (https://bugzilla.mozilla.org/show_bug.cgi?id=190655)\n*/\n\nhr {\n  height: 0; /* 1 */\n  color: inherit; /* 2 */\n}\n\n/*\nText-level semantics\n====================\n*/\n\n/**\nAdd the correct text decoration in Chrome, Edge, and Safari.\n*/\n\nabbr[title] {\n  -webkit-text-decoration: underline dotted;\n          text-decoration: underline dotted;\n}\n\n/**\nAdd the correct font weight in Edge and Safari.\n*/\n\nb,\nstrong {\n  font-weight: bolder;\n}\n\n/**\n1. Improve consistency of default fonts in all browsers. (https://github.com/sindresorhus/modern-normalize/issues/3)\n2. Correct the odd \'em\' font sizing in all browsers.\n*/\n\ncode,\nkbd,\nsamp,\npre {\n  font-family:\n\t\tui-monospace,\n\t\tSFMono-Regular,\n\t\tConsolas,\n\t\t\'Liberation Mono\',\n\t\tMenlo,\n\t\tmonospace; /* 1 */\n  font-size: 1em; /* 2 */\n}\n\n/**\nAdd the correct font size in all browsers.\n*/\n\nsmall {\n  font-size: 80%;\n}\n\n/**\nPrevent \'sub\' and \'sup\' elements from affecting the line height in all browsers.\n*/\n\nsub,\nsup {\n  font-size: 75%;\n  line-height: 0;\n  position: relative;\n  vertical-align: baseline;\n}\n\nsub {\n  bottom: -0.25em;\n}\n\nsup {\n  top: -0.5em;\n}\n\n/*\nTabular data\n============\n*/\n\n/**\n1. Remove text indentation from table contents in Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=999088, https://bugs.webkit.org/show_bug.cgi?id=201297)\n2. Correct table border color inheritance in all Chrome and Safari. (https://bugs.chromium.org/p/chromium/issues/detail?id=935729, https://bugs.webkit.org/show_bug.cgi?id=195016)\n*/\n\ntable {\n  text-indent: 0; /* 1 */\n  border-color: inherit; /* 2 */\n}\n\n/*\nForms\n=====\n*/\n\n/**\n1. Change the font styles in all browsers.\n2. Remove the margin in Firefox and Safari.\n*/\n\nbutton,\ninput,\noptgroup,\nselect,\ntextarea {\n  font-family: inherit; /* 1 */\n  font-size: 100%; /* 1 */\n  line-height: 1.15; /* 1 */\n  margin: 0; /* 2 */\n}\n\n/**\nRemove the inheritance of text transform in Edge and Firefox.\n1. Remove the inheritance of text transform in Firefox.\n*/\n\nbutton,\nselect { /* 1 */\n  text-transform: none;\n}\n\n/**\nCorrect the inability to style clickable types in iOS and Safari.\n*/\n\nbutton,\n[type=\'button\'] {\n  -webkit-appearance: button;\n}\n\n/**\nRemove the inner border and padding in Firefox.\n*/\n\n/**\nRestore the focus styles unset by the previous rule.\n*/\n\n/**\nRemove the additional \':invalid\' styles in Firefox.\nSee: https://github.com/mozilla/gecko-dev/blob/2f9eacd9d3d995c937b4251a5557d95d494c9be1/layout/style/res/forms.css#L728-L737\n*/\n\n/**\nRemove the padding so developers are not caught out when they zero out \'fieldset\' elements in all browsers.\n*/\n\nlegend {\n  padding: 0;\n}\n\n/**\nAdd the correct vertical alignment in Chrome and Firefox.\n*/\n\nprogress {\n  vertical-align: baseline;\n}\n\n/**\nCorrect the cursor style of increment and decrement buttons in Safari.\n*/\n\n/**\n1. Correct the odd appearance in Chrome and Safari.\n2. Correct the outline style in Safari.\n*/\n\n/**\nRemove the inner padding in Chrome and Safari on macOS.\n*/\n\n/**\n1. Correct the inability to style clickable types in iOS and Safari.\n2. Change font properties to \'inherit\' in Safari.\n*/\n\n/*\nInteractive\n===========\n*/\n\n/*\nAdd the correct display in Chrome and Safari.\n*/\n\nsummary {\n  display: list-item;\n}\n\n/**\n * Manually forked from SUIT CSS Base: https://github.com/suitcss/base\n * A thin layer on top of normalize.css that provides a starting point more\n * suitable for web applications.\n */\n\n/**\n * Removes the default spacing and border for appropriate elements.\n */\n\nblockquote,\ndl,\ndd,\nh1,\nh2,\nh3,\nh4,\nh5,\nh6,\nhr,\nfigure,\np,\npre {\n  margin: 0;\n}\n\nbutton {\n  background-color: transparent;\n  background-image: none;\n}\n\n/**\n * Work around a Firefox/IE bug where the transparent `button` background\n * results in a loss of the default `button` focus styles.\n */\n\nbutton:focus {\n  outline: 1px dotted;\n  outline: 5px auto -webkit-focus-ring-color;\n}\n\nfieldset {\n  margin: 0;\n  padding: 0;\n}\n\nol,\nul {\n  list-style: none;\n  margin: 0;\n  padding: 0;\n}\n\n/**\n * Tailwind custom reset styles\n */\n\n/**\n * 1. Use the user\'s configured `sans` font-family (with Tailwind\'s default\n *    sans-serif font stack as a fallback) as a sane default.\n * 2. Use Tailwind\'s default "normal" line-height so the user isn\'t forced\n *    to override it to ensure consistency even when using the default theme.\n */\n\nhtml {\n  font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; /* 1 */\n  line-height: 1.5; /* 2 */\n}\n\n/**\n * Inherit font-family and line-height from `html` so users can set them as\n * a class directly on the `html` element.\n */\n\nbody {\n  font-family: inherit;\n  line-height: inherit;\n}\n\n/**\n * 1. Prevent padding and border from affecting element width.\n *\n *    We used to set this in the html element and inherit from\n *    the parent element for everything else. This caused issues\n *    in shadow-dom-enhanced elements like <details> where the content\n *    is wrapped by a div with box-sizing set to `content-box`.\n *\n *    https://github.com/mozdevs/cssremedy/issues/4\n *\n *\n * 2. Allow adding a border to an element by just adding a border-width.\n *\n *    By default, the way the browser specifies that an element should have no\n *    border is by setting it\'s border-style to `none` in the user-agent\n *    stylesheet.\n *\n *    In order to easily add borders to elements by just setting the `border-width`\n *    property, we change the default border-style for all elements to `solid`, and\n *    use border-width to hide them instead. This way our `border` utilities only\n *    need to set the `border-width` property instead of the entire `border`\n *    shorthand, making our border utilities much more straightforward to compose.\n *\n *    https://github.com/tailwindcss/tailwindcss/pull/116\n */\n\n*,\n::before,\n::after {\n  box-sizing: border-box; /* 1 */\n  border-width: 0; /* 2 */\n  border-style: solid; /* 2 */\n  border-color: #e5e7eb; /* 2 */\n}\n\n/*\n * Ensure horizontal rules are visible by default\n */\n\nhr {\n  border-top-width: 1px;\n}\n\n/**\n * Undo the `border-style: none` reset that Normalize applies to images so that\n * our `border-{width}` utilities have the expected effect.\n *\n * The Normalize reset is unnecessary for us since we default the border-width\n * to 0 on all elements.\n *\n * https://github.com/tailwindcss/tailwindcss/issues/362\n */\n\nimg {\n  border-style: solid;\n}\n\ntextarea {\n  resize: vertical;\n}\n\ninput::-moz-placeholder, textarea::-moz-placeholder {\n  opacity: 1;\n  color: #9ca3af;\n}\n\ninput:-ms-input-placeholder, textarea:-ms-input-placeholder {\n  opacity: 1;\n  color: #9ca3af;\n}\n\ninput::placeholder,\ntextarea::placeholder {\n  opacity: 1;\n  color: #9ca3af;\n}\n\nbutton {\n  cursor: pointer;\n}\n\ntable {\n  border-collapse: collapse;\n}\n\nh1,\nh2,\nh3,\nh4,\nh5,\nh6 {\n  font-size: inherit;\n  font-weight: inherit;\n}\n\n/**\n * Reset links to optimize for opt-in styling instead of\n * opt-out.\n */\n\na {\n  color: inherit;\n  text-decoration: inherit;\n}\n\n/**\n * Reset form element properties that are easy to forget to\n * style explicitly so you don\'t inadvertently introduce\n * styles that deviate from your design system. These styles\n * supplement a partial reset that is already applied by\n * normalize.css.\n */\n\nbutton,\ninput,\noptgroup,\nselect,\ntextarea {\n  padding: 0;\n  line-height: inherit;\n  color: inherit;\n}\n\n/**\n * Use the configured \'mono\' font family for elements that\n * are expected to be rendered with a monospace font, falling\n * back to the system monospace stack if there is no configured\n * \'mono\' font family.\n */\n\npre,\ncode,\nkbd,\nsamp {\n  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;\n}\n\n/**\n * Make replaced elements `display: block` by default as that\'s\n * the behavior you want almost all of the time. Inspired by\n * CSS Remedy, with `svg` added as well.\n *\n * https://github.com/mozdevs/cssremedy/issues/14\n */\n\nimg,\nsvg,\nvideo,\ncanvas,\naudio,\niframe,\nembed,\nobject {\n  display: block;\n  vertical-align: middle;\n}\n\n/**\n * Constrain images and videos to the parent width and preserve\n * their instrinsic aspect ratio.\n *\n * https://github.com/mozdevs/cssremedy/issues/14\n */\n\nimg,\nvideo {\n  max-width: 100%;\n  height: auto;\n}\n\n.container{\n  width:100%;\n}\n\n@media (min-width: 640px){\n  .container{\n    max-width:640px;\n  }\n}\n\n@media (min-width: 768px){\n  .container{\n    max-width:768px;\n  }\n}\n\n@media (min-width: 1024px){\n  .container{\n    max-width:1024px;\n  }\n}\n\n@media (min-width: 1280px){\n  .container{\n    max-width:1280px;\n  }\n}\n\n@media (min-width: 1536px){\n  .container{\n    max-width:1536px;\n  }\n}\n\n.bg-gray-300{\n  --tw-bg-opacity:1;\n  background-color:rgba(209, 213, 219, var(--tw-bg-opacity));\n}\n\n.bg-gray-700{\n  --tw-bg-opacity:1;\n  background-color:rgba(55, 65, 81, var(--tw-bg-opacity));\n}\n\n.bg-gray-900{\n  --tw-bg-opacity:1;\n  background-color:rgba(17, 24, 39, var(--tw-bg-opacity));\n}\n\n.bg-red-300{\n  --tw-bg-opacity:1;\n  background-color:rgba(252, 165, 165, var(--tw-bg-opacity));\n}\n\n.bg-red-400{\n  --tw-bg-opacity:1;\n  background-color:rgba(248, 113, 113, var(--tw-bg-opacity));\n}\n\n.bg-yellow-400{\n  --tw-bg-opacity:1;\n  background-color:rgba(251, 191, 36, var(--tw-bg-opacity));\n}\n\n.bg-green-400{\n  --tw-bg-opacity:1;\n  background-color:rgba(52, 211, 153, var(--tw-bg-opacity));\n}\n\n.bg-green-500{\n  --tw-bg-opacity:1;\n  background-color:rgba(16, 185, 129, var(--tw-bg-opacity));\n}\n\n.bg-blue-300{\n  --tw-bg-opacity:1;\n  background-color:rgba(147, 197, 253, var(--tw-bg-opacity));\n}\n\n.bg-blue-700{\n  --tw-bg-opacity:1;\n  background-color:rgba(29, 78, 216, var(--tw-bg-opacity));\n}\n\n.bg-indigo-400{\n  --tw-bg-opacity:1;\n  background-color:rgba(129, 140, 248, var(--tw-bg-opacity));\n}\n\n.bg-purple-300{\n  --tw-bg-opacity:1;\n  background-color:rgba(196, 181, 253, var(--tw-bg-opacity));\n}\n\n.bg-purple-400{\n  --tw-bg-opacity:1;\n  background-color:rgba(167, 139, 250, var(--tw-bg-opacity));\n}\n\n.bg-pink-400{\n  --tw-bg-opacity:1;\n  background-color:rgba(244, 114, 182, var(--tw-bg-opacity));\n}\n\n.hover\\:bg-gray-600:hover{\n  --tw-bg-opacity:1;\n  background-color:rgba(75, 85, 99, var(--tw-bg-opacity));\n}\n\n.hover\\:bg-blue-500:hover{\n  --tw-bg-opacity:1;\n  background-color:rgba(59, 130, 246, var(--tw-bg-opacity));\n}\n\n.border-gray-600{\n  --tw-border-opacity:1;\n  border-color:rgba(75, 85, 99, var(--tw-border-opacity));\n}\n\n.hover\\:border-yellow-400:hover{\n  --tw-border-opacity:1;\n  border-color:rgba(251, 191, 36, var(--tw-border-opacity));\n}\n\n.hover\\:border-green-400:hover{\n  --tw-border-opacity:1;\n  border-color:rgba(52, 211, 153, var(--tw-border-opacity));\n}\n\n.hover\\:border-blue-400:hover{\n  --tw-border-opacity:1;\n  border-color:rgba(96, 165, 250, var(--tw-border-opacity));\n}\n\n.hover\\:border-indigo-400:hover{\n  --tw-border-opacity:1;\n  border-color:rgba(129, 140, 248, var(--tw-border-opacity));\n}\n\n.hover\\:border-purple-400:hover{\n  --tw-border-opacity:1;\n  border-color:rgba(167, 139, 250, var(--tw-border-opacity));\n}\n\n.hover\\:border-pink-400:hover{\n  --tw-border-opacity:1;\n  border-color:rgba(244, 114, 182, var(--tw-border-opacity));\n}\n\n.rounded{\n  border-radius:0.25rem;\n}\n\n.rounded-r-lg{\n  border-top-right-radius:0.5rem;\n  border-bottom-right-radius:0.5rem;\n}\n\n.rounded-l-lg{\n  border-top-left-radius:0.5rem;\n  border-bottom-left-radius:0.5rem;\n}\n\n.border-b-2{\n  border-bottom-width:2px;\n}\n\n.border-r{\n  border-right-width:1px;\n}\n\n.border-b{\n  border-bottom-width:1px;\n}\n\n.block{\n  display:block;\n}\n\n.flex{\n  display:flex;\n}\n\n.inline-flex{\n  display:inline-flex;\n}\n\n.table{\n  display:table;\n}\n\n.hidden{\n  display:none;\n}\n\n.flex-row{\n  flex-direction:row;\n}\n\n.flex-col{\n  flex-direction:column;\n}\n\n.flex-wrap{\n  flex-wrap:wrap;\n}\n\n.items-center{\n  align-items:center;\n}\n\n.justify-center{\n  justify-content:center;\n}\n\n.flex-1{\n  flex:1 1 0%;\n}\n\n.flex-grow{\n  flex-grow:1;\n}\n\n.float-right{\n  float:right;\n}\n\n.font-sans{\n  font-family:ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";\n}\n\n.font-mono{\n  font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;\n}\n\n.font-bold{\n  font-weight:700;\n}\n\n.h-4{\n  height:1rem;\n}\n\n.h-6{\n  height:1.5rem;\n}\n\n.h-96{\n  height:24rem;\n}\n\n.h-screen{\n  height:100vh;\n}\n\n.text-xs{\n  font-size:0.75rem;\n  line-height:1rem;\n}\n\n.text-sm{\n  font-size:0.875rem;\n  line-height:1.25rem;\n}\n\n.text-xl{\n  font-size:1.25rem;\n  line-height:1.75rem;\n}\n\n.text-3xl{\n  font-size:1.875rem;\n  line-height:2.25rem;\n}\n\n.list-none{\n  list-style-type:none;\n}\n\n.list-decimal{\n  list-style-type:decimal;\n}\n\n.m-4{\n  margin:1rem;\n}\n\n.my-2{\n  margin-top:0.5rem;\n  margin-bottom:0.5rem;\n}\n\n.my-4{\n  margin-top:1rem;\n  margin-bottom:1rem;\n}\n\n.mx-4{\n  margin-left:1rem;\n  margin-right:1rem;\n}\n\n.my-5{\n  margin-top:1.25rem;\n  margin-bottom:1.25rem;\n}\n\n.mx-auto{\n  margin-left:auto;\n  margin-right:auto;\n}\n\n.mt-0{\n  margin-top:0px;\n}\n\n.mt-2{\n  margin-top:0.5rem;\n}\n\n.mb-2{\n  margin-bottom:0.5rem;\n}\n\n.mr-3{\n  margin-right:0.75rem;\n}\n\n.mt-4{\n  margin-top:1rem;\n}\n\n.mb-4{\n  margin-bottom:1rem;\n}\n\n.mt-6{\n  margin-top:1.5rem;\n}\n\n.mr-6{\n  margin-right:1.5rem;\n}\n\n.mt-12{\n  margin-top:3rem;\n}\n\n.mb-12{\n  margin-bottom:3rem;\n}\n\n.min-h-screen{\n  min-height:100vh;\n}\n\n.p-2{\n  padding:0.5rem;\n}\n\n.p-4{\n  padding:1rem;\n}\n\n.px-0{\n  padding-left:0px;\n  padding-right:0px;\n}\n\n.py-1{\n  padding-top:0.25rem;\n  padding-bottom:0.25rem;\n}\n\n.py-2{\n  padding-top:0.5rem;\n  padding-bottom:0.5rem;\n}\n\n.py-3{\n  padding-top:0.75rem;\n  padding-bottom:0.75rem;\n}\n\n.px-3{\n  padding-left:0.75rem;\n  padding-right:0.75rem;\n}\n\n.py-4{\n  padding-top:1rem;\n  padding-bottom:1rem;\n}\n\n.px-4{\n  padding-left:1rem;\n  padding-right:1rem;\n}\n\n.pb-1{\n  padding-bottom:0.25rem;\n}\n\n.pl-1{\n  padding-left:0.25rem;\n}\n\n.pb-2{\n  padding-bottom:0.5rem;\n}\n\n.pl-9{\n  padding-left:2.25rem;\n}\n\n.pt-20{\n  padding-top:5rem;\n}\n\n.static{\n  position:static;\n}\n\n.fixed{\n  position:fixed;\n}\n\n.top-0{\n  top:0px;\n}\n\n*{\n  --tw-shadow:0 0 #0000;\n}\n\n*{\n  --tw-ring-inset:var(--tw-empty,/*!*/ /*!*/);\n  --tw-ring-offset-width:0px;\n  --tw-ring-offset-color:#fff;\n  --tw-ring-color:rgba(59, 130, 246, 0.5);\n  --tw-ring-offset-shadow:0 0 #0000;\n  --tw-ring-shadow:0 0 #0000;\n}\n\n.table-fixed{\n  table-layout:fixed;\n}\n\n.text-center{\n  text-align:center;\n}\n\n.text-right{\n  text-align:right;\n}\n\n.text-black{\n  --tw-text-opacity:1;\n  color:rgba(0, 0, 0, var(--tw-text-opacity));\n}\n\n.text-white{\n  --tw-text-opacity:1;\n  color:rgba(255, 255, 255, var(--tw-text-opacity));\n}\n\n.text-gray-100{\n  --tw-text-opacity:1;\n  color:rgba(243, 244, 246, var(--tw-text-opacity));\n}\n\n.text-gray-400{\n  --tw-text-opacity:1;\n  color:rgba(156, 163, 175, var(--tw-text-opacity));\n}\n\n.text-red-400{\n  --tw-text-opacity:1;\n  color:rgba(248, 113, 113, var(--tw-text-opacity));\n}\n\n.text-green-400{\n  --tw-text-opacity:1;\n  color:rgba(52, 211, 153, var(--tw-text-opacity));\n}\n\n.hover\\:text-white:hover{\n  --tw-text-opacity:1;\n  color:rgba(255, 255, 255, var(--tw-text-opacity));\n}\n\n.hover\\:text-yellow-100:hover{\n  --tw-text-opacity:1;\n  color:rgba(254, 243, 199, var(--tw-text-opacity));\n}\n\n.hover\\:text-green-100:hover{\n  --tw-text-opacity:1;\n  color:rgba(209, 250, 229, var(--tw-text-opacity));\n}\n\n.hover\\:text-blue-100:hover{\n  --tw-text-opacity:1;\n  color:rgba(219, 234, 254, var(--tw-text-opacity));\n}\n\n.hover\\:text-indigo-100:hover{\n  --tw-text-opacity:1;\n  color:rgba(224, 231, 255, var(--tw-text-opacity));\n}\n\n.hover\\:text-purple-100:hover{\n  --tw-text-opacity:1;\n  color:rgba(237, 233, 254, var(--tw-text-opacity));\n}\n\n.hover\\:text-pink-100:hover{\n  --tw-text-opacity:1;\n  color:rgba(252, 231, 243, var(--tw-text-opacity));\n}\n\n.uppercase{\n  text-transform:uppercase;\n}\n\n.underline{\n  text-decoration:underline;\n}\n\n.no-underline{\n  text-decoration:none;\n}\n\n.hover\\:underline:hover{\n  text-decoration:underline;\n}\n\n.hover\\:no-underline:hover{\n  text-decoration:none;\n}\n\n.antialiased{\n  -webkit-font-smoothing:antialiased;\n  -moz-osx-font-smoothing:grayscale;\n}\n\n.align-middle{\n  vertical-align:middle;\n}\n\n.w-4{\n  width:1rem;\n}\n\n.w-6{\n  width:1.5rem;\n}\n\n.w-1\\/2{\n  width:50%;\n}\n\n.w-1\\/12{\n  width:8.333333%;\n}\n\n.w-3\\/12{\n  width:25%;\n}\n\n.w-4\\/12{\n  width:33.333333%;\n}\n\n.w-5\\/12{\n  width:41.666667%;\n}\n\n.w-8\\/12{\n  width:66.666667%;\n}\n\n.w-9\\/12{\n  width:75%;\n}\n\n.w-full{\n  width:100%;\n}\n\n.z-20{\n  z-index:20;\n}\n\n@-webkit-keyframes spin{\n  to{\n    transform:rotate(360deg);\n  }\n}\n\n@keyframes spin{\n  to{\n    transform:rotate(360deg);\n  }\n}\n\n@-webkit-keyframes ping{\n  75%, 100%{\n    transform:scale(2);\n    opacity:0;\n  }\n}\n\n@keyframes ping{\n  75%, 100%{\n    transform:scale(2);\n    opacity:0;\n  }\n}\n\n@-webkit-keyframes pulse{\n  50%{\n    opacity:.5;\n  }\n}\n\n@keyframes pulse{\n  50%{\n    opacity:.5;\n  }\n}\n\n@-webkit-keyframes bounce{\n  0%, 100%{\n    transform:translateY(-25%);\n    -webkit-animation-timing-function:cubic-bezier(0.8,0,1,1);\n            animation-timing-function:cubic-bezier(0.8,0,1,1);\n  }\n\n  50%{\n    transform:none;\n    -webkit-animation-timing-function:cubic-bezier(0,0,0.2,1);\n            animation-timing-function:cubic-bezier(0,0,0.2,1);\n  }\n}\n\n@keyframes bounce{\n  0%, 100%{\n    transform:translateY(-25%);\n    -webkit-animation-timing-function:cubic-bezier(0.8,0,1,1);\n            animation-timing-function:cubic-bezier(0.8,0,1,1);\n  }\n\n  50%{\n    transform:none;\n    -webkit-animation-timing-function:cubic-bezier(0,0,0.2,1);\n            animation-timing-function:cubic-bezier(0,0,0.2,1);\n  }\n}\n\n@media (min-width: 640px){\n}\n\n@media (min-width: 768px){\n  .md\\:my-0{\n    margin-top:0px;\n    margin-bottom:0px;\n  }\n\n  .md\\:py-3{\n    padding-top:0.75rem;\n    padding-bottom:0.75rem;\n  }\n\n  .md\\:pb-0{\n    padding-bottom:0px;\n  }\n}\n\n@media (min-width: 1024px){\n  .lg\\:flex{\n    display:flex;\n  }\n\n  .lg\\:items-center{\n    align-items:center;\n  }\n\n  .lg\\:mt-0{\n    margin-top:0px;\n  }\n\n  .lg\\:w-auto{\n    width:auto;\n  }\n}\n\n@media (min-width: 1280px){\n}\n\n@media (min-width: 1536px){\n}',""]),n.exports=o}},[[154,18,2,19]]]);