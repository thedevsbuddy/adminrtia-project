Object.defineProperty(String.prototype, "ucFirst", {
    value: function ucFirst(preserveAfter = false) {
        return (
            this[0].toUpperCase() +
            (preserveAfter
                ? this.substring(1)
                : this.substring(1).toLowerCase())
        );
    },
    writable: true,
    configurable: true,
});

Object.defineProperty(String.prototype, "snake", {
    value: function ucFirst() {
        return this.split(" ").join("_");
    },
    writable: true,
    configurable: true,
});
