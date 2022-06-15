import {isEmpty, isNil} from "./guards";

export const errorMessages = {
    NOT_EMPTY: "Field must not be empty",
    NOT_A_FILE: "Field must be a valid file"
}

export const isFile = (arg: unknown): arg is File => !isNil(arg) && arg instanceof File;

export const isNotEmptyFile = (arg: unknown): arg is File =>  isFile(arg) && !isEmpty(arg.name) && arg.size !== 0;
export const isEmptyFile = (arg: unknown): arg is File => isFile(arg) && !isNotEmptyFile(arg);