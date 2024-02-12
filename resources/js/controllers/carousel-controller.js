export default class extends window.Controller
{
    connect() {
        this.element.querySelectorAll('.oi-carousel').forEach(el => {
            new window.Bootstrap.Carousel(el, {

            })
        })
    }
}
