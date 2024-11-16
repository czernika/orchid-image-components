// @see https://typicode.github.io/husky/how-to.html#ci-server-and-docker
if (process.env.CI === 'true') {
    process.exit(0)
}

const husky = (await import('husky')).default

console.log(husky())
