<div class="form-group">
    <label for="dosen_id">Dosen:</label>
    {{ Form::select('dosen_id', $pembimbing, null, ['class' => 'form-control', 'id' => 'dosen_id']) }}
    <input type="hidden" name="tugas_akhir_id" value="{{ $id }}">
    <input type="hidden" name="jabatan" value="1">
    <input type="hidden" name="status" value="1">
</div>