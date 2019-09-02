Name: {{ $data['name'] }} <br>
email: {{ $data['email'] }}<br>
New Password: {{ decrypt($data['password']) }}<br>