class diagram json
```
{"user":{"name":"user","attributes":["username"],"methods":["createGroup","addFriend","addMembers","sendMessage"],"inheritances":[],"x":1.34375,"y":412,"width":180,"height":144},"group":{"name":"group","attributes":["owner","groupname"],"methods":[],"inheritances":[],"x":192.34375,"y":412,"width":180,"height":96},"membership":{"name":"membership","attributes":["groupname","member_username"],"methods":[],"inheritances":[],"x":121.34375,"y":313,"width":180,"height":96},"message":{"name":"message","attributes":["date","author","content","reciever","reciever_type"],"methods":[],"inheritances":[],"x":15.34375,"y":55,"width":180,"height":144},"inbox":{"name":"inbox","attributes":["message_id","reciever","reciever_type"],"methods":[],"inheritances":[],"x":206.34375,"y":57,"width":180,"height":112}}
```



consolon tailwind template

```
<div class="flex h-screen bg-gray-900">
  <!-- Left Section -->
  <div class="flex w-1/4 flex-col justify-between bg-gray-800">
    <!-- Search Bar -->
    <input type="text" placeholder="Search" class="w-full border-none bg-gray-700 py-2 pl-4 text-white focus:outline-none" />

    <!-- Previously Messaged Users/Groups -->
    <div class="flex-grow border-t border-gray-400 pt-4">
      <!-- User/Group items go here -->
      <div class="bg-blue-800 py-1 pl-4 text-white">sera</div>
      <div class="py-1 pl-4 text-white hover:bg-gray-900">kinji (<b>4</b>)</div>
      <div class="py-1 pl-4 text-white hover:bg-gray-900">YAKOS (<b>+</b>)</div>
      <!-- Add more users/groups as needed -->
    </div>
    <!-- Command Bar -->
    <input type="text" placeholder="/Command" class="w-full border-t border-gray-400 bg-gray-700 py-2 pl-4 text-white focus:outline-none" />
  </div>

  <!-- Right Section -->

  <label class="w-3/4 border-l border-gray-400 bg-black">
    <!-- Current Partner Info -->
    <div class="border-b border-gray-400 px-4 py-2 text-white">
      <h1>@<b>sera</b> (2)</h1>
    </div>

    <!-- Messages -->
    <div class="overflow-y-auto px-4 py-2">
      <div class="text-blue-600">[ 2024 ]</div>
      <div class="text-blue-600">[ June 01 ]</div>
      <div class="text-blue-600">[ July 19 ]</div>
      <!-- Sample Messages -->
      <div class="text-green-400"><span class="text-xs text-gray-400">12:00</span> <b>Yuri</b>: How are you?</div>

      <div class="text-white"><span class="text-xs text-gray-400">14:12</span> <b>Kinzo</b>: Sorry for answering late, I was busy with these kids, anyways, yes, fine.</div>

      <!-- Add more messages as needed -->
          <div class="text-blue-600">> inbox <</div>
      <div class="text-gray-400"><span class="text-xs text-gray-400">16:00</span> How are you?</div>
      <div class="text-gray-400"><span class="text-xs text-gray-400">17:12</span> I want to ask you something urgent.</div>
      <div class="text-yellow-400"><span class="text-xs text-gray-400">17:12</span> /block</div>

      <div style="bottom:0;padding-bottom:0.5em;" class="bg-black fixed w-full flex gap-1 border-t border-gray-600 pt-2 text-white">[17:16:01] <input class="w-full bg-transparent outline-none" placeholder="Kinzo:" /></div>
    </div>
  </label>
</div>

```


log in page

```


<div class="flex h-screen bg-gray-900">
  <!-- Left Section -->
  <div class="flex w-1/4 flex-col justify-between bg-gray-800">
    <!-- Search Bar -->
    <div class="h-10 w-full bg-gray-700 pl-4 flex items-center text-white font-bold">CONSOLON</div>

    <!-- Previously Messaged Users/Groups -->
    <div class="flex-grow border-t border-gray-400 pt-4">
      <!-- User/Group items go here -->
      <div class="bg-blue-800 py-1 pl-4 text-white">register</div>
      <div class="py-1 pl-4 text-white hover:bg-gray-900">login</div>
      <!-- Add more users/groups as needed -->
    </div>
  </div>

  <!-- Right Section -->

  <label class="w-3/4 border-l border-gray-400 bg-black">
    <!-- Current Partner Info -->
    <div class="border-b border-gray-400 px-4 py-2 text-white">
      <h1>@<b>login</b></h1>
    </div>

    <!-- Messages -->
    <div class="overflow-y-auto px-4 py-2">
      <div class="text-blue-600">* 2024 ></div>
      <div class="text-blue-600">* June 01 ></div>
      <!-- Sample Messages -->
      <div class="text-green-400"><b>>>></b> Username</div>

      <div class="text-white">SorryYt</div>
      <div class="text-red-400"><b>!</b> Username not found</div>
      <div class="text-green-400"><b>>>></b> Username</div>
      <div class="text-white">SorryYt</div>
      <div class="text-green-400"><b>>>></b> Password</div>
      <div class="text-white">****</div>

      <div class="mt-2 flex gap-1 border-t border-gray-600 pt-2 text-white">GUEST <input class="w-full bg-transparent outline-none" placeholder="Password:" /></div>
    </div>
  </label>
</div>


```

