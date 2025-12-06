<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Adoptions</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        table th, table td { border: 1px solid #ccc; padding: 6px; font-size: 12px; }
        .img-cell img { width: 50px; height: 50px; object-fit: cover; border-radius: 4px; }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>User Document</th>
                <th>User Fullname</th>
                <th>User Phone</th>
                <th>User Photo</th>
                <th>Pet Name</th>
                <th>Pet Kind</th>
                <th>Pet Breed</th>
                <th>Pet Location</th>
                <th>Pet Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adopts as $adopt)
            <tr>
                <td>{{ optional($adopt->user)->document }}</td>
                <td>{{ optional($adopt->user)->fullname }}</td>
                <td>{{ optional($adopt->user)->phone }}</td>
                <td class="img-cell">
                    @php $uph = optional($adopt->user)->photo ?? 'no-photo.webp'; @endphp
                    @php $uext = strtolower(substr($uph, -4)); @endphp
                    @if($uext != 'webp' && $uext != '.svg')
                        <img src="{{ public_path().'/images/'.$uph }}" />
                    @else
                        Webp|SVG
                    @endif
                </td>
                <td>{{ optional($adopt->pet)->name }}</td>
                <td>{{ optional($adopt->pet)->kind }}</td>
                <td>{{ optional($adopt->pet)->breed }}</td>
                <td>{{ optional($adopt->pet)->location }}</td>
                <td class="img-cell">
                    @php $pph = optional($adopt->pet)->image ?? 'no-image.png'; @endphp
                    @php $pext = strtolower(substr($pph, -4)); @endphp
                    @if($pext != 'webp' && $pext != '.svg')
                        <img src="{{ public_path().'/images/'.$pph }}" />
                    @else
                        Webp|SVG
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
