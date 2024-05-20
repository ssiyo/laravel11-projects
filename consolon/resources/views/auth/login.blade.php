<x-guest-layout>

    <form action="{{route('login')}}" method="post">
        @csrf
        <input type="hidden" name="username">
        <input type="hidden" name="password">
    </form>
    <script>
        document.addEventListener("keydown", (event) => {
            if (event.key == "Enter") {
                let entered = entry.value.trim()
                if (entered == '') return;
                chatm('sent', entered);
                if (username == ''){
                    if (users.find(u => u.unsermae == entered)){
                        chatm("error", "username already exists")
                    } else {
                        username = entered
                        chatm("reciever", ">>> password")
                    }
                } else if (password == ''){
                    if (valid){
                        chatm("recieved", ">>> confirm password")
                    } else {
                        chatm("error", "invalid password");
                    }
                }

                entry.value = '';
            }
        })

        init();

        function init() {
            chatm("info", "2024");
            chatm("info", "June 01");
            chatm("recieved", ">>> username");
        }
    </script>
</x-guest-layout>