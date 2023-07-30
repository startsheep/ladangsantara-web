<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('showDeleteConfirmation', dataId => {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#1F2937',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteData', dataId);
                }
            })
        });
    });
</script>

<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('showDeleteSuccess', function() {
            Swal.fire({
                title: "Selamat!",
                text: "Data berhasil dihapus",
                icon: "success"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('reloadData');
                }
            });
        });
    });
</script>
