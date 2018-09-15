<fieldset>
<section>
    {!! Form::label('id', 'id:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('id', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('name', 'name:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('name', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('tipo', 'tipo:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('tipo', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('descripcion', 'descripcion:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('descripcion', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('stock', 'stock:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('stock', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('precio', 'precio:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('precio', null, ['class' => 'input-xs']) !!}
    </label>
</section><section>
    {!! Form::label('impuesto_id', 'impuesto_id:',['class' => 'label']) !!}
    <label class="input">
         {!! Form::text('impuesto_id', null, ['class' => 'input-xs']) !!}
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
</section>
</fieldset>
<footer> 
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin1.ingredientes.index') !!}" class="btn btn-default">Cancel</a>
</footer>