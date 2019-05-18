function Post(props) {
    return (
      <article>
        <h1>{props.slug}</h1>
      </article>
    )
  }
  
  Post.getInitialProps = async function(context) {
    const { slug } = context.query
    return { slug }
  }
  
  export default Post