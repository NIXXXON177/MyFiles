const dns = require('dns');

const subdomains = [
    'www', 'api', 'cdn', 'mail', 'admin', 'dev', 'test',
    'support', 'socialclub', 'store', 'launcher', 'cloud',
    'media', 'games', 'secure', 'auth', 'login', 'forum',
    'blog', 'news', 'status', 'monitor', 'assets', 'static'
];

console.log('Сканирование субдоменов rockstargames.com...\n');

subdomains.forEach(sub => {
    dns.resolve(`${sub}.rockstargames.com`, (err, ip) => {
        if (!err && ip) {
            console.log(`${sub}.rockstargames.com -> ${ip}`);
        }
    });
});