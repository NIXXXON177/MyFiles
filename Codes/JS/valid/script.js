document.getElementById('num').addEventListener('input', function (e) {
    var input = e.target.value;
    var cleaned = input.replace(/\D/g, '');
    var formatted = '';

    if (cleaned.length > 11) {
        cleaned = cleaned.substring(0, 11);
    }

    if (cleaned.length > 0) {
        formatted = '+7'; 
        if (cleaned.startsWith('7') || cleaned.startsWith('8')) {
            cleaned = cleaned.substring(1);
        }
    }
    
    var remaining = cleaned;

    if (remaining.length > 0) {
        var area = remaining.substring(0, 3);
        formatted += ' (' + area;
        remaining = remaining.substring(3);
    }
    
    if (remaining.length > 0) {
        formatted += ') ';
    }

    if (remaining.length > 0) {
        var part1 = remaining.substring(0, 3);
        formatted += part1;
        remaining = remaining.substring(3);
    }

    if (remaining.length > 0) {
        var part2 = remaining.substring(0, 2);
        formatted += '-' + part2;
        remaining = remaining.substring(2);
    }

    if (remaining.length > 0) {
        var part3 = remaining.substring(0, 2);
        formatted += '-' + part3;
    }
    
    e.target.value = formatted;
});
