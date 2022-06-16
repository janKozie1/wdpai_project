export type InitToastsReturnValue = Readonly<{
    open: (text: string) => void;
}>

const initToasts = (): InitToastsReturnValue => {
    const open: InitToastsReturnValue['open'] = (text) => {

    }

    return {
        open,
    }
}

export default initToasts;