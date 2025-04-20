<h2 class="text-xl font-bold mb-4">CV Filtering Result</h2>

<pre>
@foreach ($data['labels'] as $i => $label)
Label: {{ $label }}
Confidence: {{ $data['scores'][$i] * 100 }}%
@endforeach
</pre>

