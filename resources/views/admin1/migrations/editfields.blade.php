<fieldset>
<section>
    {!! Form::label('id', 'id:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('id', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('migration', 'migration:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('migration', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('batch', 'batch:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('batch', null, ['class' => 'input-xs']) !!}
    </label>
</section>
</fieldset>
<footer> 
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin1.migrations.index') !!}" class="btn btn-default">Cancel</a>
</footer>