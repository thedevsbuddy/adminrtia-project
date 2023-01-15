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
    value: function snake() {
        return this.split(" ").join("_");
    },
    writable: true,
    configurable: true,
});

Object.defineProperty(String.prototype, "kebab", {
    value: function kebab() {
        return this.split(" ")
            .map((e) => e.toLowerCase())
            .join("-");
    },
    writable: true,
    configurable: true,
});
