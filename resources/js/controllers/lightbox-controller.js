import GLightbox from 'glightbox'
import '@css/lightbox.css'

export default class extends window.Controller
{
    connect() {
        this.lightbox = GLightbox({
            // @see https://github.com/biati-digital/glightbox#slide-options
        })
    }
}
