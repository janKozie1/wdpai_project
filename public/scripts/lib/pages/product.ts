import initDrawer, {InitDrawerReturnValue} from "../common/drawer";
import initToasts, {InitToastsReturnValue} from "../common/toasts";
import initForm from "../common/form";
import {Nullable} from "../common/utils/types";
import {isEmpty, isNil} from "../common/utils/guards";
import {errorMessages, isFile} from "../common/utils/validation";
import {not} from "../common/utils/fn";

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

type EditItemResponse = Readonly<{
    isValid: boolean;
    validData: Nullable<{id: string}>,
    messages: Partial<Readonly<{
        name: string;
        image: string;
        description: string;
        unit: string;
    }>>
}>

document.addEventListener("DOMContentLoaded", () => {
    const drawerMethods = initDrawer({name: "editItem"});
    const toastMethods = initToasts();

    document.querySelector('button#button--delete')?.addEventListener('click', onDelete(drawerMethods, toastMethods))

    initForm({
        formName: "editItem",
        onSuccess: async (validFormData, setErrors) => {
            try {
                const response: Nullable<EditItemResponse> = await (await fetch(location.pathname, {
                    method: 'POST',
                    body: validFormData,
                })).json();

                if (isNil(response)) {
                    return toastMethods.open("Something went wrong, try again later");
                }

                if (response.isValid && !isNil(response.validData)) {
                    drawerMethods.close();
                    location.reload();
                } else {
                    setErrors(Object.entries(response.messages).map(([field, error]) => ({
                        error,
                        name: field,
                    })))
                }
            } catch {
                return toastMethods.open("Something went wrong, try again later");
            }
        },
        fieldValidations:  {
            "name": [{
                error: errorMessages.NOT_EMPTY,
                fn: not(isEmpty),
            }],
            "image": [{
                error: errorMessages.NOT_A_FILE,
                fn: isFile,
            }],
            "description": [{
                error: errorMessages.NOT_EMPTY,
                fn: not(isEmpty),
            }],
            "unit": [{
                error: errorMessages.NOT_EMPTY,
                fn: not(isEmpty),
            }]
        }
    });
})