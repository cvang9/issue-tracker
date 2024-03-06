import userEvent from '@testing-library/user-event'
import { render } from '@testing-library/vue'
import router from '../router/router'
import { createPinia } from 'pinia'
const customRender = (component, options) => {
    const user = userEvent.setup()
    const result = render(component, {
        global: {
            plugins: [router, createPinia()]
        },
        ...options
    })
    return { user, result }
}
export * from '@testing-library/vue'
export { customRender as render }
export { router }