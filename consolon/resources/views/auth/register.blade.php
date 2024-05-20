<x-guest-layout>


    <!-- Messages -->
    <script>
        init();

        function init() {
            chatm('info', "2002");
            chatm('info', 'January 11');
            chatm('recieved', '>>> username');

            chatm('sent', 'SorryYt');
            chatm("error", "username not found");


            chatm('recieved', '>>> Username');
            chatm('sent', 'SorryYt');
            chatm('recieved', '>>> Password');
            chatm('sent', '****');
        }
    </script>

</x-guest-layout>