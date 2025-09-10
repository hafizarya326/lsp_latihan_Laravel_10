@extends('layout.main')
@section('name')
    <h3>Tambahkan Nilai</h3>
@endsection

@section('content')
    <p>Create Nilai</p>

    @if(session('error'))
    <p class="text-danger">{{ session('error') }}</p>
    @endif

    <form class="form" action="/nilai-raport/store" method="POST">
        @csrf
        <table>
            <tr class="position">
                <td>
                    <label for="">Nama Siswa : </label>
                </td>
                <td>
                    <select name="siswa_id" id="siswa_id" required>
                        <option value="">Pilih Siswa</option>
                        @foreach ($siswa as $each)
                        <option value="{{ $each->id }}">{{ $each->nama_siswa }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

            <tr class="position">
                <td>
                    <label for="Matematika">Matematika: </label>
                </td>
                <td>
                    <input type="text" name="matematika" id="matematika" step="0.1" min="0" max="100" required>
                </td>
            </tr>

            <tr class="position">
                <td>
                    <label for="Indonesia">Indonesia: </label>
                </td>
                <td>
                    <input type="text" name="indonesia" id="indonesia" step="0.1" min="0" max="100" required>
                </td>
            </tr>

            <tr class="position">
                <td>
                    <label for="Inggris">Inggris: </label>
                </td>
                <td>
                    <input type="text" name="inggris" id="inggris" step="0.1" min="0" max="100" required>
                </td>
            </tr>

            <tr class="position">
                <td>
                    <label for="Kejuruan">Kejuruan: </label>
                </td>
                <td>
                    <input type="text" name="kejuruan" id="kejuruan" step="0.1" min="0" max="100" required>
                </td>
            </tr>

            <tr class="position">
                <td>
                    <label for="pilihan">Pilihan: </label>
                </td>
                <td>
                    <input type="text" name="pilihan" id="pilihan" step="0.1" min="0" max="100" required>
                </td>
            </tr>
        </table>
        <button class="button-submit" type="submit">Simpan</button>
    </form>
@endsection