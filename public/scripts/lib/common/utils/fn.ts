export const not = (fn: (...args: unknown[]) => boolean) => (...args: unknown[]) => !fn(...args);