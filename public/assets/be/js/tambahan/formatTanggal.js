function formatTanggal() {
    const date = new Date();
    // tambah properti day: 'numeric' dan month: 'long'
    const dateFormatter = new Intl.DateTimeFormat('id', {
        day: 'numeric',
        month: 'long',
        weekday: "long",
        year: "numeric"
    });
    const sekarang = dateFormatter.format(date);

    return sekarang
}