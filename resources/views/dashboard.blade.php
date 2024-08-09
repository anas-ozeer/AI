<x-layout>
        <form action="{{ route('ai.generate') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <label for="prompt" class="text-lg font-bold">Please enter your prompt for the AI</label>
            <input type="text" id="prompt" name="prompt"/>
            <button class="mt-2">Ask</button>
        </form>

            @if(session('ai_response'))
            <div id="response">
                {!! Str::markdown(session('ai_response')) !!}
            </div>
        @endif
</x-layout>
