"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const guards_1 = require("./utils/guards");
const drawerActiveClass = "drawer--expanded";
const bindDrawerState = ({ drawer, button, }) => {
    var _a, _b;
    const updateState = (newState) => {
        if (newState) {
            drawer.root.classList.add(drawerActiveClass);
        }
        else {
            drawer.root.classList.remove(drawerActiveClass);
        }
    };
    button.addEventListener("click", () => updateState(true));
    (_a = drawer.cancelButton) === null || _a === void 0 ? void 0 : _a.addEventListener("click", () => updateState((false)));
    (_b = drawer.xButton) === null || _b === void 0 ? void 0 : _b.addEventListener("click", () => updateState((false)));
};
const getDrawerControlls = (root) => ({
    root,
    xButton: root.querySelector('button[data-drawer-node="xButton"]'),
    cancelButton: root.querySelector('button[data-drawer-node="cancelButton"]'),
});
const initDrawer = (name, containerNode = document.body) => {
    const drawerNode = containerNode.querySelector(`#drawer--${name}`);
    const drawerToggleButton = containerNode.querySelector(`button#drawer_button--${name}`);
    if ((0, guards_1.isNil)(drawerNode) || (0, guards_1.isNil)(drawerToggleButton)) {
        return;
    }
    bindDrawerState({
        button: drawerToggleButton,
        drawer: getDrawerControlls(drawerNode),
    });
};
exports.default = initDrawer;
