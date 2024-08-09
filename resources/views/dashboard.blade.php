<x-layout>
    <form id="ai-form" action="{{ route('ai.generate.ajax') }}" method="POST">
        @csrf
        <label for="prompt" class="text-lg font-bold">Please enter your prompt for the AI</label>
        <input type="text" id="prompt" name="prompt" />
        <button type="submit" class="mt-2">Ask</button>
    </form>

    <div id="response">
        <!-- AI Response will be inserted here -->
    </div>

    <script>
        $(document).ready(function() {
            $('#ai-form').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Display loading message
                $('#response').html('<div>Generating Prompt...</div>');

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function(response) {
                        try {
                            if (response.error) {
                                $('#response').html('<div>' + response.error + '</div>');
                            } else {
                                $('#response').html('<div>' + response.response + '</div>');
                            }
                        } catch (e) {
                            $('#response').html('<div>' + 'An error occured!' + '</div>');
                        }
                    },
                });
            });
        });
    </script>
</x-layout>
