"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.isEmpty = exports.isLiteral = exports.isNotNil = exports.isNil = exports.isString = void 0;
const isString = (arg) => typeof arg === 'string';
exports.isString = isString;
const isNil = (arg) => arg === null || arg === undefined;
exports.isNil = isNil;
const isNotNil = (arg) => !(0, exports.isNil)(arg);
exports.isNotNil = isNotNil;
const isLiteral = (arg) => {
    if (typeof arg !== 'object') {
        return false;
    }
    if ((0, exports.isNil)(arg)) {
        return false;
    }
    if (Object.getPrototypeOf(arg) === null) {
        return true;
    }
    return Object.getPrototypeOf(Object.getPrototypeOf(arg)) === null;
};
exports.isLiteral = isLiteral;
function isEmpty(arg) {
    if (arg === null || arg === undefined) {
        return true;
    }
    if ((0, exports.isString)(arg) && arg.trim() === '') {
        return true;
    }
    if ((0, exports.isLiteral)(arg) && Object.keys(arg).length === 0) {
        return true;
    }
    if (Array.isArray(arg) && arg.length === 0) {
        return true;
    }
    return false;
}
exports.isEmpty = isEmpty;
