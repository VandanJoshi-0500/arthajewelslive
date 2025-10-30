<!DOCTYPE html>
<html>
<head>
    <title>New Catalog Request</title>
</head>
<body>
    <h1>New Catalog Request</h1>
    <p>Name: {{ $data['name'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Phone: {{ $data['phone'] }}</p>
    <p>Country: {{ $data['country'] }}</p>
    <p>Company: {{ $data['company'] }}</p>
    <p>Category: {{ implode(', ', $data['category']) }}</p>
    <p>Collection: {{ implode(', ', $data['collection']) }}</p>
    <p>Comments: {{ $data['comments'] }}</p>

    @if ($attachment)
        <p>Attachment: {{ $attachment->getClientOriginalName() }}</p>
    @endif

    <p>Thank you for your submission!</p>
</body>
</html>
