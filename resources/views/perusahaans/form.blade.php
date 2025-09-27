{{-- resources/views/perusahaans/form.blade.php --}}

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- NIB --}}
    <div>
        <label for="nib" class="block text-sm font-medium text-gray-700">NIB</label>
        <input type="text" id="nib" name="nib"
               value="{{ old('nib', $perusahaan->nib ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('nib') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Nama Perusahaan --}}
    <div>
        <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
        <input type="text" id="nama_perusahaan" name="nama_perusahaan"
               value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('nama_perusahaan') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Skala Usaha --}}
    <div>
        <label for="skala_usaha" class="block text-sm font-medium text-gray-700">Skala Usaha</label>
        <input type="text" id="skala_usaha" name="skala_usaha"
               value="{{ old('skala_usaha', $perusahaan->skala_usaha ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('skala_usaha') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Nama Proyek --}}
    <div>
        <label for="nama_proyek" class="block text-sm font-medium text-gray-700">Nama Proyek</label>
        <input type="text" id="nama_proyek" name="nama_proyek"
               value="{{ old('nama_proyek', $perusahaan->nama_proyek ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    {{-- Alamat Usaha --}}
    <div class="md:col-span-2">
        <label for="alamat_usaha" class="block text-sm font-medium text-gray-700">Alamat Usaha</label>
        <textarea id="alamat_usaha" name="alamat_usaha" rows="2"
                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('alamat_usaha', $perusahaan->alamat_usaha ?? '') }}</textarea>
    </div>

    {{-- Kecamatan --}}
    <div>
        <label for="kecamatan_usaha" class="block text-sm font-medium text-gray-700">Kecamatan</label>
        <input type="text" id="kecamatan_usaha" name="kecamatan_usaha"
               value="{{ old('kecamatan_usaha', $perusahaan->kecamatan_usaha ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    {{-- Kelurahan --}}
    <div>
        <label for="kelurahan_usaha" class="block text-sm font-medium text-gray-700">Kelurahan</label>
        <input type="text" id="kelurahan_usaha" name="kelurahan_usaha"
               value="{{ old('kelurahan_usaha', $perusahaan->kelurahan_usaha ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    {{-- Jenis Usaha --}}
    <div>
        <label for="jenis_usaha" class="block text-sm font-medium text-gray-700">Jenis Usaha</label>
        <input type="text" id="jenis_usaha" name="jenis_usaha"
               value="{{ old('jenis_usaha', $perusahaan->jenis_usaha ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    {{-- Nomor Identitas User --}}
    <div>
        <label for="nomor_identitas_user" class="block text-sm font-medium text-gray-700">Nomor Identitas User</label>
        <input type="text" id="nomor_identitas_user" name="nomor_identitas_user"
               value="{{ old('nomor_identitas_user', $perusahaan->nomor_identitas_user ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email"
               value="{{ old('email', $perusahaan->email ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Nomor Telepon --}}
    <div>
        <label for="nomor_telp" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
        <input type="text" id="nomor_telp" name="nomor_telp"
               value="{{ old('nomor_telp', $perusahaan->nomor_telp ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    {{-- Modal Usaha --}}
    <div>
        <label for="modal_usaha" class="block text-sm font-medium text-gray-700">Modal Usaha</label>
        <input type="number" id="modal_usaha" name="modal_usaha"
               value="{{ old('modal_usaha', $perusahaan->modal_usaha ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    {{-- Tenaga Kerja --}}
    <div>
        <label for="tenaga_kerja" class="block text-sm font-medium text-gray-700">Tenaga Kerja</label>
        <input type="number" id="tenaga_kerja" name="tenaga_kerja"
               value="{{ old('tenaga_kerja', $perusahaan->tenaga_kerja ?? '') }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
    </div>

    {{-- Label --}}
    <div class="md:col-span-2">
        <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
        <select id="label" name="label"
                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <option value="">-- Pilih Label --</option>
            <option value="Layak" 
                {{ old('label', $perusahaan->label ?? '') == 'Layak' ? 'selected' : '' }}>
                Layak
            </option>
            <option value="Tidak Layak" 
                {{ old('label', $perusahaan->label ?? '') == 'Tidak Layak' ? 'selected' : '' }}>
                Tidak Layak
            </option>
            <option value="Dipertimbangkan" 
                {{ old('label', $perusahaan->label ?? '') == 'Dipertimbangkan' ? 'selected' : '' }}>
                Dipertimbangkan
            </option>
        </select>
        @error('label')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>
    
    
</div>
