<div class="form-group">
    <label for="tugas_akhir_id">Nama Mahasiswa</label>
    {{ Form::select('tugas_akhir_id', $tugas_akhir,null, ['class' => 'form-control', 'id' => 'tugas_akhir_id', 'placeholder' => 'Nama Mahasiswa']) }}
</div>

<div class="form-group">
    <label for="semhas_at">Tanggal Seminar Proposal</label>
    {{ Form::input('date', 'sempro_at', null, ['class' => 'form-control', 'id' => 'semhas_at', 'placeholder' => 'Tanggal Seminar Proposal']) }}
</div>

<div class="form-group">
    <label for="semhas_time">Waktu Seminar Proposal</label>
    {{ Form::input('time', 'sempro_time', null, ['class' => 'form-control', 'id' => 'semhas_time', 'placeholder' => 'Waktu Seminar Proposal']) }}
</div>  

<div class="form-group">
    <label for="proposal_status">Status Proposal</label>
    {{ Form::SELECT('proposal_status', ['1'=>'1', '2'=>'2',], null, ['class' => 'form-control', 'id' => 'proposal_status', 'placeholder' => 'Status Proposal']) }}
</div>


<div class="form-group">
    <label for="file_proposal">File Proposal (PDF)</label>
    {{ Form::file('file_proposal', null,)}}
</div>

<div class="form-group">
    <label for="semhas_deadline_at">Semhas Deadline</label>
    {{ Form::input('date', 'semhas_deadline_at', null, ['class' => 'form-control', 'id' => 'semhas_deadline', 'placeholder' => 'Deadline Seminar Proposal']) }}
</div>