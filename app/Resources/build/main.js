import $ from 'jquery';
import uikit from 'uikit';
import icons from 'uikit/dist/js/uikit-icons';

const {router}  = require('../../../vendor/friendsofsymfony/jsrouting-bundle/Resources/public/js/router.js');
module.exports = router;

console.log("main : resources/main.js");
uikit.use(icons);