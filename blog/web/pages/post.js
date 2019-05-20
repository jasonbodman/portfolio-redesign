import client from '../client'

function Post(props) {
  return (
    <article>
      <h1>{props.title}</h1>
    </article>
  )
}

Post.getInitialProps = async function(context) {
  const { slug } = context.query
  return await client.fetch('*[_type == "post" && slug.current == $slug][0]', { slug })
}

export default Post