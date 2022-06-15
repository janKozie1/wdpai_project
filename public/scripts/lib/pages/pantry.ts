import initDrawer from "../common/drawer";
import initForm from "../common/form";
import {errorMessages, isNotEmptyFile} from "../common/utils/validation";
import {not} from "../common/utils/fn";
import {isEmpty, isNil} from "../common/utils/guards";
import {Nullable} from "../common/utils/types";
import initToasts from "../common/toasts";

type CreateItemResponse = Readonly<{
    isValid: boolean;
    data: Nullable<{id: string}>,
    messages: Partial<Readonly<{
        name: string;
        image: string;
        description: string;
        unit: string;
    }>>
}>

document.addEventListener("DOMContentLoaded", () => {
    const drawerMethods = initDrawer({name: "addItem"});
    const toastMethods = initToasts();

    initForm({
        formName: "addItem",
        onSuccess: async (validFormData, setErrors) => {
            try {
                const response: Nullable<CreateItemResponse> = await (await fetch('/product', {
                    method: 'POST',
                    body: validFormData,
                })).json();

                if (isNil(response)) {
                    return toastMethods.open("Something went wrong, try again later");
                }

                if (response.isValid && !isNil(response.data)) {
                    drawerMethods.close();
                    window.location.replace(`/product/${response.data.id}`)
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
                fn: isNotEmptyFile,
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