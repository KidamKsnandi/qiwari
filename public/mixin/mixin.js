const rupiah = (number, prefix = undefined) => {
    // return new Intl.NumberFormat("id-ID", {
    //     style: "currency",
    //     currency: "IDR",
    // }).format(number);
    let isMinus = "";
    if (parseInt(number) < 0) {
        isMinus = "-";
    }
    if (number) {
        const number_string = number
            .toString()
            .replace(/[^,\d]/g, "")
            .toString();
        const split = number_string.split(",");
        const sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        const ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        let separator = "";

        // tambahkan titik jika yang di input sudah menjadi number ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? `${rupiah},${split[1]}` : rupiah;
        rupiah = `${isMinus}${rupiah}`;
        return `Rp. ${rupiah}`;
    }

    return number;
};
