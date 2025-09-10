@extends('layout.main')

@section('main')
  <h3>Edit Nilai {{ ($siswa->nama_siswa ?? $nilai->siswa->nama_siswa ?? '-') }}</h3>
@endsection

@section('content')
  @if (session('error'))
    <p class="text-danger">{{ session('error') }}</p>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul style="margin:0;padding-left:18px">
        @foreach ($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form class="form" action="{{ url('/nilai-raport/update/'.$nilai->id) }}" method="POST" class="form">
    @csrf
    @method('PUT')

    @php
      $student = $siswa ?? ($nilai->siswa ?? null);
    @endphp

    <table class="table-form">
      <tr class="position">
        <td><label for="siswa_id">Nama Siswa :</label></td>
        <td>
          <input type="hidden" name="siswa_id" id="siswa_id"
                 value="{{ old('siswa_id', $student->id ?? $nilai->siswa_id) }}" required>
          <input type="text" value="{{ $student->nama_siswa ?? '-' }}" readonly>
        </td>
      </tr>

      <tr class="position">
        <td><label for="matematika">Matematika :</label></td>
        <td>
          <input type="number" name="matematika" id="matematika"
                 step="0.01" min="0" max="100" required
                 value="{{ old('matematika', $nilai->matematika) }}">
        </td>
      </tr>

      <tr class="position">
        <td><label for="indonesia">Indonesia :</label></td>
        <td>
          <input type="number" name="indonesia" id="indonesia"
                 step="0.01" min="0" max="100" required
                 value="{{ old('indonesia', $nilai->indonesia) }}">
        </td>
      </tr>

      <tr class="position">
        <td><label for="inggris">Inggris :</label></td>
        <td>
          <input type="number" name="inggris" id="inggris"
                 step="0.01" min="0" max="100" required
                 value="{{ old('inggris', $nilai->inggris) }}">
        </td>
      </tr>

      <tr class="position">
        <td><label for="kejuruan">Kejuruan :</label></td>
        <td>
          <input type="number" name="kejuruan" id="kejuruan"
                 step="0.01" min="0" max="100" required
                 value="{{ old('kejuruan', $nilai->kejuruan) }}">
        </td>
      </tr>

      <tr class="position">
        <td><label for="pilihan">Pilihan :</label></td>
        <td>
          <input type="number" name="pilihan" id="pilihan"
                 step="0.01" min="0" max="100" required
                 value="{{ old('pilihan', $nilai->pilihan) }}">
        </td>
      </tr>
    </table>

    <button class="button-submit" type="submit">Simpan</button>
  </form>
</div>
@endsection
