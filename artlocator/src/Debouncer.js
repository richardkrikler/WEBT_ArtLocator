export class Debouncer {
    constructor(delay) {
        this.delay = delay
    }

    debounce(func) {
        if (this.timeoutId) {
            clearTimeout(this.timeoutId)
        }

        this.timeoutId = setTimeout(func, this.delay);
    }
}