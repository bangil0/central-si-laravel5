<div class="form-group">
    <label for="dosen_id">Dosen:</label>
    {{ Form::select('dosen_id', $pembimbing, null, ['class' => 'form-control','placeholder'=> 'Nama Pembimbing', 'id' => 'dosen_id']) }}
    <input type="hidden" name="tugas_akhir_id" value="{{ $id }}">
    <input type="hidden" name="status" value=1>
</div>

<div class="form-group">
         <label for="status_proposal">Jabatan:</label>
        <select name="jabatan" id="jabatan" class="form-control" required>
        <option value="1">Pembimbing Utama</option>
        <option value="2">Pembimbing Pendamping</option>
        </select>
</div>

