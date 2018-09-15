<fieldset>
<section>
    {!! Form::label('id', 'id:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('id', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('ingrediente_id', 'ingrediente_id:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('ingrediente_id', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('receta_id', 'receta_id:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('receta_id', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('cantidad', 'cantidad:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('cantidad', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('created_at', 'created_at:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('created_at', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('updated_at', 'updated_at:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('updated_at', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('unidad', 'unidad:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('unidad', null, ['class' => 'input-xs']) !!}
    </label>
</section>
</fieldset>
<footer> 
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin1.ingredientereceta.index') !!}" class="btn btn-default">Cancel</a>
</footer>