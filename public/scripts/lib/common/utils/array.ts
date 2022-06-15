import {Nullable} from "./types";

export const last = <T>(arr: T[]): Nullable<T> => arr[arr.length - 1];