import {isEmpty, isNil, isNotNil} from "./utils/guards";
import {last} from "./utils/array";
import {Nullable} from "./utils/types";

type Validation = Readonly<{
    fn: (data: unknown) => boolean;
    error: string;
}>

const errorContainerAttr = 'data-error-container';

const createError = (contents: string) => {
    const container = document.createElement('div');
    container.classList.add('-pl--700', '-mt--400');
    container.setAttribute(errorContainerAttr, "true");


    const textWrapper = document.createElement('span');
    textWrapper.classList.add('text__paragraph--small--regular');

    const text = document.createElement('span');
    text.classList.add('-color--state_error');

    text.textContent = contents;
    textWrapper.appendChild(text);
    container.appendChild(textWrapper);

    return container;
}

type FieldValidations = Record<string, Validation[]>;
type FieldValidationResult = Readonly<{
    name: string;
    error: string;
}>

const validateForm = (formData: FormData, fieldValidations: FieldValidations): FieldValidationResult[] => {
    return Object.entries(fieldValidations).map(([fieldName, validations]) => {
        const input = formData.get(fieldName);

        const failedValidation = validations
            .find((validation) => !validation.fn(input));

        return isNil(failedValidation) ? null : {
            name: fieldName,
            error: failedValidation.error,
        }
    }).filter(isNotNil);
}

const getErrorMessageContainer = (inputNode: Nullable<Element>): Nullable<Element> => {
    if (isNil(inputNode)) {
        return null;
    }

    if (inputNode instanceof HTMLInputElement) {
        if (inputNode.type === "radio") {
            return inputNode?.parentElement?.parentElement?.parentElement;
        }
    };

    return inputNode.parentElement;
}

const appendErrors = (form: HTMLFormElement, errors: FieldValidationResult[]) => {
    errors.forEach((error) => {
        const target = getErrorMessageContainer(form.querySelector(`[name="${error.name}"]`));
        target?.appendChild(createError(error.error));
    })
}

const clearErrors = (form: HTMLFormElement, fieldValidations: FieldValidations) => {
    Object.keys(fieldValidations).forEach((inputName) => {
        const errorContainer = form.querySelector(`[name="${inputName}"] + [${errorContainerAttr}]`);
        errorContainer?.remove();
    })
}

type ScopedAppendErrors = (errors: FieldValidationResult[]) => void;

type InitFormArg = Readonly<{
    formName: string,
    fieldValidations: FieldValidations,
    onSuccess: (formData: FormData, setErrors: ScopedAppendErrors) => void,
    containerNode?: Element;
}>

const initForm = ({
    formName,
    onSuccess,
    containerNode = document.body,
    fieldValidations,
}: InitFormArg) => {
    const form = containerNode.querySelector(`#form--${formName}`);

    if (isNil(form) || !(form instanceof HTMLFormElement)) {
        return;
    }

    form.addEventListener('submit', (e) => {
        const formData = new FormData(form);
        e.preventDefault();

        clearErrors(form, fieldValidations);
        const validationErrors = validateForm(formData, fieldValidations);

        if (!isEmpty(validationErrors)) {
            appendErrors(form, validationErrors);
        } else {
            onSuccess(formData, (errors) => appendErrors(form, errors))
        }
    })
}

export default initForm;