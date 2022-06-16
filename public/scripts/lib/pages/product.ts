import initDrawer from "../common/drawer";

import initToasts from "../common/toasts";

document.addEventListener("DOMContentLoaded", () => {
    const drawerMethods = initDrawer({name: "editItem"});
    const toastMethods = initToasts();
})