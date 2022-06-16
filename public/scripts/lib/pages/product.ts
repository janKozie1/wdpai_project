import initDrawer, {InitDrawerReturnValue} from "../common/drawer";
import initToasts, {InitToastsReturnValue} from "../common/toasts";

const onDelete = (drawerControls: InitDrawerReturnValue, toastsControls: InitToastsReturnValue) => async () => {
    try {
        const response = await (await fetch(location.pathname, {
            method: 'DELETE'
        })).json()

        if (response.ok) {
            drawerControls.close();
            location.replace('/pantry');
        } else {
            toastsControls.open('Something went wrong')
        }
    } catch {
        toastsControls.open('Something went wrong')
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const drawerMethods = initDrawer({name: "editItem"});
    const toastMethods = initToasts();

    document.querySelector('button#button--delete')?.addEventListener('click', onDelete(drawerMethods, toastMethods))
})