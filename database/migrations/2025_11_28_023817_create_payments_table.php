Schema::create('payments', function (Blueprint $table) {
    $table->id();

    // Relasi ke users (jamaah)
    $table->foreignId('user_id')->constrained()->onDelete('cascade');

    // Relasi ke packages (jika ada)
    $table->foreignId('package_id')->nullable()->constrained()->onDelete('set null');

    // Nominal pembayaran
    $table->decimal('amount', 12, 2);

    // Metode pembayaran
    $table->string('method')->nullable(); // contoh: "transfer", "cash"

    // Status pembayaran
    $table->enum('status', ['pending', 'confirmed', 'rejected'])->default('pending');

    // Bukti pembayaran
    $table->string('proof')->nullable();

    // Tanggal pembayaran
    $table->dateTime('payment_date')->nullable();

    $table->timestamps();
});
