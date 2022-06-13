import {isNil} from "./utils/guards";
import {Nullable} from "./utils/types";

const drawerActiveClass = "drawer--expanded";

type Drawer = Readonly<{
    root: Element;
    xButton: Nullable<Element>;
    cancelButton: Nullable<Element>;
}>

type BindDrawerStateArg = Readonly<{
    button: Element;
    drawer: Drawer;
}>

const bindDrawerState = ({
    drawer,
    button,
}: BindDrawerStateArg) => {
    const updateState = (newState: boolean) => {
        if (newState) {
            drawer.root.classList.add(drawerActiveClass);
        } else {
            drawer.root.classList.remove(drawerActiveClass);
        }
    }

    button.addEventListener("click", () => updateState(true));

    drawer.cancelButton?.addEventListener("click", () => updateState((false)));
    drawer.xButton?.addEventListener("click", () => updateState((false)));
}

const getDrawerControlls = (root: Element): Drawer => ({
    root,
    xButton: root.querySelector('button[data-drawer-node="xButton"]'),
    cancelButton: root.querySelector('button[data-drawer-node="cancelButton"]'),
})

const initDrawer = (name: string, containerNode: HTMLElement = document.body) => {
    const drawerNode = containerNode.querySelector(`#drawer--${name}`);
    const drawerToggleButton = containerNode.querySelector(`button#drawer_button--${name}`);

    if (isNil(drawerNode) || isNil(drawerToggleButton)) {
        return;
    }

    bindDrawerState({
        button: drawerToggleButton,
        drawer: getDrawerControlls(drawerNode),
    })
}

export default initDrawer;