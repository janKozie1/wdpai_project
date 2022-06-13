"use strict";
var __importDefault = (this && this.__importDefault) || function (mod) {
    return (mod && mod.__esModule) ? mod : { "default": mod };
};
Object.defineProperty(exports, "__esModule", { value: true });
const drawer_1 = __importDefault(require("../common/drawer"));
const init = () => {
    (0, drawer_1.default)("addItem");
};
document.addEventListener("DOMContentLoaded", init);
