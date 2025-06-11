<!DOCTYPE html>
<html>
<head>
    <title>Tasks List</title>
</head>
<body>
    <form method="POST" action="/tasks">
    @csrf
    <input type="text" name="title" placeholder="Enter new task">
    <button type="submit">Add Task</button>
</form>

<ul>
@foreach($tasks as $task)
    <li><a href="/tasks/{{ $task->id }}">{{ $task->title }}</a> - {{ $task->created_at->format('d M Y') }}</li>
@endforeach
</ul>

// resources/views/tasks/show.blade.php
<h2>{{ $task->title }}</h2>
<p>Created: {{ $task->created_at->format('d M Y, h:i A') }}</p>
<p>Status: {{ $task->completed ? 'Completed' : 'Pending' }}</p>
<a href="/tasks">Back to Task List</a>

</body>
</html>
